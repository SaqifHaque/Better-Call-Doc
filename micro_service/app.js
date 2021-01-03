//declaration
const express = require('express');
const bodyParser = require('body-parser');
const exSession = require('express-session');
const cookieParser = require('cookie-parser');
//const registration = require('./controller/registration');
//const login = require('./controller/login');
//const pincode = require('./controller/pincode');
//const userdash = require('./controller/userdash');
//const download = require('./controller/download');
//const logout = require('./controller/logout');
const search = require('./controller/search');
const app = express();
const toastr = require('express-toastr');
const fileUpload = require('express-fileupload');
require('dotenv').config();

//config
app.set('view engine', 'ejs');
//middleware
//app.use('/assets', express.static('assets'));
//app.use(bodyParser.urlencoded({ extended: true }));
//app.use(exSession({ secret: 'my secret value', saveUninitialized: true, resave: false }));
//app.use(cookieParser());
//app.use(fileUpload({
//    useTempFiles: true,
//    tempFileDir: '/tmp/'
//}));
//app.use(toastr());


//app.use('/userdash', userdash);
app.use('/user', search);


//route
app.get('/', (req, res) => {
    res.send('Hello from express server');
});
//server startup
app.listen(2020, (error) => {
    console.log('express server started at 2020...');
});