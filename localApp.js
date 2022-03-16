const express = require('express')
const app = express()
const cors = require('cors');
const corsOptions = {
    origin: 'http://localhost:3000',
    credentials: true,            //access-control-allow-credentials:true
    optionSuccessStatus: 200
}
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(cors(corsOptions));
app.use(express.static('public'))

app.listen(3000, () => { })

app.get('/open', function (req, res) {
    var today = new Date();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds() + "." + today.getMilliseconds();
    console.log('DSLR OPENED AT', time, req.query);
    res.header("Access-Control-Allow-Origin", "*");
    openDslr()
    res.send('Parameters received: ' + JSON.stringify(req.query));
});

const openDslr = () => {
    require('child_process').exec('cmd /c startDslr.bat', function () {
        // …your callback code may run here…
    });
}

