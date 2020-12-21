const express = require('express');
const router = express.Router();
const mysql = require('mysql');
const session = require('express-session');
const { json } = require('body-parser');
const e = require('express');
const MySQLStore = require('express-mysql-session')(session);
const pool = mysql.createPool({
  host: 'bbyrr0jlx8u24trqcs1g-mysql.services.clever-cloud.com',
  database: 'bbyrr0jlx8u24trqcs1g',
  user: 'up1jnbft1dtjweia',
  password: 'pjRz42Cq5BX0Y40XLTtP',
  port: '3306'
})

var sessionStore = new MySQLStore( {} , pool )

router.use(session({
    secret: 'esto es secreto',
    resave: true,
    saveUninitialized: false,
    store: sessionStore,
    createDatabaseTable: true

}));

router.get('/', (req , res ) => {
    
    res.render('login.html', { title: 'Log-in'});
    //res.send(`has visto esta pagina : ${req.session.cuenta} `);
});
router.get('/experiencia',(req, res) => {
    var status = req.session.estatus
    res.render('experiencia.html', { title: 'Experiencia' , status});
});

router.get('/home',(req, res) => {
    var nombre = req.session.usuario;
    var estatus = req.session.estatus;
    res.render('home.html', {title: 'Home' , nombre, estatus} );
});
router.get('/gestion/:tipo_lab?',(req, res) => {
  if(req.session.estatus=='profesor'){
    var { tipo_lab } = req.params
    if(!tipo_lab){
      res.render('gestion.html', { title: 'Gestion'});
    }
    else{
      if(tipo_lab == 'normal'){
        res.render('gestion labs.html', { title: 'Gestion'});
      }
      else if(tipo_lab == 'fisica'){
        res.render('gestion fisica.html' , {title : 'Gestion'});
      }
      else{
        res.send(`<h1> tipo del lab :${ tipo_lab }</h1>`)
      }
      
    }
    
  }
  else{
    res.send("<h1>Lo sentimos, hackea a tu profesor si quieres acceder a gestion</h1>")
  }
});


router.get('/laboratorios', (req,res) => {
  var estatus = req.session.estatus;

  var sql = "SELECT laboratorio.nombreLaboratorio,usuario.nombreUsuario,usuario.apellidoUsuario FROM ((( laboratorio INNER JOIN crea_laboratorio ON laboratorio.idLaboratorio = crea_laboratorio.idLaboratorio) INNER JOIN profesor ON profesor.idProfesor = crea_laboratorio.idProfesor) INNER JOIN usuario ON profesor.rutUsuario = usuario.rutUsuario)"
  var lista = []
  var nombre = []
  var apellido = []
  pool.getConnection(function(err,connection){
    if (err) throw err;

    connection.query(sql , function(error , resultado , campos){
      if(resultado.length > 0)
      { 
        for(i in resultado){
          lista.push(resultado[i].nombreLaboratorio)
          nombre.push(resultado[i].nombreUsuario)
          apellido.push(resultado[i].apellidoUsuario)
        }
        res.render('laboratorios.html' , { estatus , lista, nombre,apellido });
      }
      else
      {
        console.log('no se encontraron laboratorios')
        res.render('laboratorios.html' , { estatus , lista, nombre , apellido });
      }
      connection.release();     
        // Handle error after the release.
      if (error) throw error;   

    })
  })
})

router.get('/laboratorios/:nombre?' , (req,res) => {
  const { nombre } = req.params
  sql = "SELECT datos , tipo FROM laboratorio WHERE nombreLaboratorio = ? "
  var status = req.session.estatus

  if(!nombre){
    res.send('<h1> vacio bro </h1>')
  }
  else{
    pool.getConnection(function(err,connection){
      if (err) throw err;
      connection.query(sql , [nombre] , function(error , resultado , campos){
        if(resultado.length > 0){
          if(resultado[0].tipo == 'venturi'){
            datos = resultado[0].datos //SI EL TIPO ES VENTURI DIRECCIONAR A LA VISTA DE LABS VENTURI, SINO A OTRA GENERAL
            console.log(datos)
            console.log(resultado[0].tipo)
            res.render('experiencia.html' ,{status , datos , nombre})
          }
          else{
            datos = resultado[0].datos
            res.send(`<h1>Nombre del lab: ${nombre}`)
          }
          
        }
        else{
          res.send(`<h1>Nombre del lab: ${nombre}`)
        }

        connection.release()
        if (error) throw error;  

      })
    })
    
  }  
})
router.get('/resultados', (req, res) => {
  var estatus = req.session.estatus;
  res.render('resultados.html' , {estatus})
})

router.get('/resultados/:nombre?' , (req,res) => {
  var {nombre} = req.params
  var estatus = req.session.estatus;
  console.log(nombre)
  res.render('resultados_all.html' ,{estatus})
})

router.post('/laboratorios/:nombre?' , (req , res) => {
  var {nombre} = req.params
  console.log(req.body)
  console.log(nombre)
})

router.post('/gestion/fisica', (req,res)=>{
  var { nombre , datos } = req.body
  var aux = JSON.stringify(datos)
  var rut = req.session.rut_usuario
  var id_profe = 0
  var id_lab = 0

  var sql = "INSERT INTO laboratorio (nombreLaboratorio , datos , tipo) VALUES ( ? , ? , ?)"
  var sql2 = "INSERT INTO crea_laboratorio (idLaboratorio , idProfesor) VALUES ( ? , ? ) "
  var sql3 = "SELECT * FROM profesor WHERE rutUsuario = ? "
  var sql4 = "SELECT idLaboratorio,nombreLaboratorio FROM laboratorio WHERE nombreLaboratorio = ? "


  pool.getConnection(function(err,connection){
    if (err) throw err;
    connection.query(sql , [nombre , aux , "venturi" ], function(error , resultado , campos){
      console.log('laboratorio insertado correctamente')
      pool.query( sql3 , [rut] , function(error2, resultado2){
        if (error2) throw error2;
        id_profe = resultado2[0].idProfesor

        pool.query(sql4 , [nombre] , function(error3 , resultado3){
          if (error3) throw error3;
          id_lab = resultado3[0].idLaboratorio
          
          pool.query(sql2, [ id_lab , id_profe], function(error4 , resultado4){
            if (error4) throw error4;
            console.log('relacion creada')
          })
        })

      })
      connection.release();     
              // Handle error after the release.
      if (error) throw error; 
    })    
  })
})

router.post('/gestion',(req,res)=> { 
  var {Laboratorio , variables } = req.body
  console.log(req.body)
  var sql = "SELECT * FROM profesor WHERE rutUsuario = ? "
  var sql2 = "INSERT INTO laboratorio (nombreLaboratorio, datos , tipo ) VALUES (? ,? ,?) "
  var sql4 = "SELECT * FROM laboratorio WHERE nombreLaboratorio = ? "
  //var sql3 = "INSERT INTO variable (nombreVariable , valorVariable , unidadMedicion, idLaboratorio) VALUES ? "
  var sql5 = "INSERT INTO crea_laboratorio (idLaboratorio , idProfesor) VALUES ( ? , ? ) "
  var rut = req.session.rut_usuario
  var id_lab = 0
  var id_profe = 0
  //console.log(variables) 
  
  var aux = JSON.stringify(variables)
  var dato = '{ "variables" : '+ aux + '}'
  //console.log(dato)

  pool.getConnection(function(err,connection){
    if (err) throw err;

    connection.query(sql , [rut] , function(error,resultado ,campos){

      if(resultado.length > 0){
        console.log(resultado[0].idProfesor)
        id_profe = resultado[0].idProfesor

        pool.query(sql2 , [Laboratorio , dato ,"normal"] , function(error2 ,resultado2){
          if (error2) throw error2;
          console.log('laboratorio insertado')

          pool.query(sql4,[Laboratorio] , function(error3, resultado3){
          if(error3) throw error3;
          console.log(resultado3[0].idLaboratorio)
          id_lab = resultado3[0].idLaboratorio
          
          pool.query(sql5 , [ id_lab , id_profe] , function(error5 , resultado5){
            if(error5) throw error5;
            console.log('crea_lab -- Filas afectadas: ' + resultado5.affectedRows)
            
            })
          })
        })
        
      }
      else{
        console.log('no se encuentra el rut')
      }

      connection.release();     
        // Handle error after the release.
      if (error) throw error; 
    })
  })
})

router.post('/' , (req,res) => {
    const { user , contra } = req.body ;
    
    const sql = "SELECT * FROM usuario WHERE nombreUsuario = ? AND contraseniaUsuario = ?" 
    const sql2 = "SELECT * FROM alumno WHERE rutUsuario = ? "
    const sql3 = "SELECT * FROM profesor WHERE rutUsuario = ? "
    console.log(req.body)
    pool.getConnection(function(err, connection) {
      if (err) throw err; // not connected!     
      // Use the connection   
      connection.query( sql, [user , contra] , function (error, resultado, fields) {

        // When done with the connection, release it.
        if(resultado.length > 0 ){
          console.log('usuario correcto' + user);
          const rut = resultado[0].rutUsuario
          //req.session.conectado = req.session.conectado ? req.session.conectado = true : true ;
          pool.query(sql2, [rut] , function(error2 , resultado2){
            if(error2) throw error2;
            if(resultado2.length > 0){
              req.session.usuario = req.session.usuario ? req.session.usuario = user : user ;
              req.session.rut_usuario = req.session.rut_usuario ? req.session.rut_usuario = rut: rut ;
              req.session.estatus = req.session.estatus ? req.session.estatus = 'alumno' : 'alumno' ; 
              console.log('alumno encontrado')
              res.redirect('/home')
            } else {
              pool.query(sql3 , [rut] , function(error3 , resultado3){
                if(error3) throw error3;
                if(resultado3.length > 0){
                  req.session.usuario = req.session.usuario ? req.session.usuario = user : user ;
                  req.session.rut_usuario = req.session.rut_usuario ? req.session.rut_usuario = rut: rut ;
                  req.session.estatus = req.session.estatus ? req.session.estatus = 'profesor' : 'profesor' ; 
                  console.log('profe encontrado')
                  res.redirect('/home')

                }
              })
            }
          })
        } 
        else{ 
          console.log('Usuario incorrecto')
          res.redirect('/') }

        connection.release();     
        // Handle error after the release.
        if (error) throw error;    
        // Don't use the connection here, it has been returned to the pool.
      });
    });
})
module.exports = router;
