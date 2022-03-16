import React, { Component } from 'react'
import axios from 'axios';
import CircularProgress from '@mui/material/CircularProgress';
import Button from '@mui/material/Button';
import Box from '@mui/material/Box';

export default class ScanQr extends Component {
    constructor(props) {
        super(props);
        this.state = { loading: false, qrImgSrc: '', charge: {}, isSuccess: false, isFail: false };

    }

    componentDidMount() {
        this.createPaymentSource();
        this.checkChargeStatus(true)
    }

    componentWillUnmount() {
        console.log('unmount')
        this.checkChargeStatus(false)
    }

    render() {
        return (
            <div className="div-list-qr" style={{ width: '100%', height: '100vh', display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                {!this.state.isFail && <div style={{ width: "400px", height: "400px", }}>
                    {this.state.qrImgSrc === '' && <div style={{ marginTop: '200px' }}><CircularProgress /></div>}
                    {this.state.qrImgSrc !== '' && <img style={{ marginBottom: '200px' }} src={this.state.qrImgSrc} alt="qrCode" />}
                </div>}
                {this.state.isFail && this.renderFailScreen()}
            </div>
        )
    }

    renderFailScreen = () => {
        return <div style={{ width: "100%", height: "400px", display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
            <Box>
                <div>ทำรายการล้มเหลว กรุณาลองใหม่อีกครั้ง</div>
                <Button style={{ marginTop: '25px' }} variant="outlined" onClick={() => window.location.reload()}>ตกลง</Button>
            </Box>

        </div>
    }

    callDslr = () => {
        axios.get('http://localhost:3000/open').then(res => {
            if (res) {
                window.location.replace('/');
            }
        })
    }

    createPaymentSource = () => {
        const { OmiseCard, Omise } = window
        Omise.setPublicKey('pkey_5qev9qhktbmayq7inwz');
        Omise.createSource('promptpay', {
            "amount": 15500,
            "currency": "THB"
        }, (statusCode, response) => {
            this.setState({ loading: true })
            axios.post('https://pb-api.xcard.live/create-payment', {
                source: response.id
            }).then(res => {
                this.setState({
                    qrImgSrc: res.data.charge.source.scannable_code.image.download_uri,
                    charge: res.data.charge
                })
            })

        });
    }

    toggleDslr = () => {
        this.callDslr()
    }

    checkChargeStatus = (isMouted) => {
        console.log('call')
        let myInterval;
        let count = 0;
        if (isMouted) {
            myInterval = setInterval(() => {
                axios.post('https://pb-api.xcard.live/retrieve-charge', {
                    chargeId: this.state.charge.id
                }).then(res => {
                    this.setState({ isSuccess: res.data.response.status === 'successful' })
                    if (!!this.state.isSuccess) {
                        clearInterval(myInterval);
                        this.toggleDslr();
                        return;
                    }
                    if (res.data.response.status === 'failed') {
                        this.setState({ isFail: true })
                    }
                    if (count > 10) {
                        clearInterval(myInterval);
                        window.location.replace('/')
                        return;
                    }
                })
                count++
            }, 10000);
        }
        else {
            clearInterval(myInterval);
            return;
        }
    }
}
