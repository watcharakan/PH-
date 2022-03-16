const express = require('express')
const app = express()
// var bat_open = require.resolve('./startDslr.bat');
// var spawn = require('child_process').spawn,
//     ls = spawn('cmd.exe', ['/c', 'my.bat']);

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

const omise = require("omise")({
    publicKey: 'pkey_5qev9qhktbmayq7inwz',
    secretKey: 'skey_5qfpbic1bq3t2pq1cts'
});

const cors = require('cors');
const corsOptions = {
    origin: 'http://localhost:3000',
    credentials: true,            //access-control-allow-credentials:true
    optionSuccessStatus: 200
}
app.use(cors(corsOptions));
app.use(express.static('public'))

app.get('/', function (req, res) {
    var today = new Date();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds() + "." + today.getMilliseconds();
    console.log(time, req.query);
    res.header("Access-Control-Allow-Origin", "*");
    res.send('Parameters received: ' + JSON.stringify(req.query));
});

app.get('/open', function (req, res) {
    var today = new Date();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds() + "." + today.getMilliseconds();
    console.log('DSLR OPENED AT', time, req.query);
    res.header("Access-Control-Allow-Origin", "*");
    openDslr()
    res.send('Parameters received: ' + JSON.stringify(req.query));
});

const openDslr = () => {
    require('child_process').exec('cmd /c pay_succeed.vbs', function () {
        // …your callback code may run here…
    });
}

app.post('/create-payment', async (req, res, next) => {
    try {
        const charge = await omise.charges.create({
            amount: '15500',
            source: req.body.source,
            currency: "thb",
        });
        res.send({ charge });
    } catch (err) {
        console.log(err);
    }
    next();
});

app.post('/retrieve-charge', async (req, res, next) => {
    try {
        let response;
        const charge = await omise.charges.retrieve(req.body.chargeId, function (error, charge) {
            response = charge
            console.log('response', response)
        });
        res.send({ response });
    } catch (err) {
        console.log(err);
    }
    next();
});


app.listen(3000);