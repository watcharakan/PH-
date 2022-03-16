import React from "react";
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Container, Row, Col } from 'react-bootstrap';
import Button from '@mui/material/Button';
import { Link } from "react-router-dom";
import '../App.css';
import image from '../assets/images.png'

class List extends React.Component {
    constructor(props) {
        super(props);
        this.state = { change: true };
    }

    componentDidMount() {
        axios.defaults.headers.common['Access-Control-Allow-Origin'] = "*"
    }
    navigateToList = () => {
        window.location.replace('/payment');
    }
    render() {
        return (
            <div className="div-list-bg" style={{ width: '100%', height: '100vh', display: 'flex', justifyContent: 'center', alignItems: 'center' }} onClick={() => this.navigateToList()}>
                <div style={{ width: '75%', display: 'flex', height: '750px' }}>
                    <div style={{ width: '50%', height: '100%' }}>
                        <Row>
                            <Col style={{ padding: '10px', marginRight: '20px' }}>
                                {/* <img style={{ minWidth: '120px', width: '100%', objectFit: 'contain' }} src={image} /> */}
                            </Col>
                            <Col style={{ padding: '10px', marginRight: '20px' }}>
                                {/* <img style={{ minWidth: '120px', width: '100%', objectFit: 'contain' }} src={image} /> */}
                            </Col>
                        </Row>
                        <Row style={{ marginTop: '20px' }}>
                            <Col style={{ padding: '10px', marginRight: '20px' }}>
                                {/* <img style={{ minWidth: '120px', width: '100%', objectFit: 'contain' }} src={image} /> */}
                            </Col>
                            <Col style={{ padding: '10px', marginRight: '20px' }}>
                                {/* <img style={{ minWidth: '120px', width: '100%', objectFit: 'contain' }} src={image} /> */}
                            </Col>
                        </Row>
                        <Row style={{ marginTop: '20px' }}>
                            <Col style={{ padding: '10px', marginRight: '20px' }}>
                                {/* <img style={{ minWidth: '120px', width: '100%', objectFit: 'contain' }} src={image} /> */}
                            </Col>
                            <Col style={{ padding: '10px', marginRight: '20px' }}>
                                {/* <img style={{ minWidth: '120px', width: '100%', objectFit: 'contain' }} src={image} /> */}
                            </Col>
                        </Row>
                    </div>
                    <div style={{ width: '50%', height: '100%', display: 'flex', alignItems: 'flex-start', paddingTop: '30px', color: 'black', flexDirection: 'column', marginLeft: '40px' }}>
                        {/* <h2>3 Acts (2 Copies)</h2>
                        <Container style={{ width: '70%', marginTop: '20px' }}>
                            <Row>
                                <Col style={{ textAlign: 'left', color: 'grey' }}>Tickket</Col>
                                <Col style={{ textAlign: 'right' }}>150</Col>
                                <Col>THB</Col>
                            </Row>
                            <Row>
                                <Col style={{ textAlign: 'left', color: 'grey' }}>Service</Col>
                                <Col style={{ textAlign: 'right' }}>5</Col>
                                <Col>THB</Col>
                            </Row>
                            <Row>
                                <Col style={{ textAlign: 'left', color: 'grey' }}>Total</Col>
                                <Col style={{ textAlign: 'right' }}>155</Col>
                                <Col>THB</Col>
                            </Row>
                        </Container> */}
                        <div style={{ width: '100%' }}>
                            {/* <div style={{ width: '100%', height: '250px', textAlign: 'left', marginTop: '50px' }}></div>
                            <Link to="/payment">
                                <Button style={{ width: '80%', backgroundColor: 'black', color: 'white' }}>PAY</Button>
                            </Link> */}
                            {/* <Button style={{ width: '80%', backgroundColor: 'black', color: 'white' }} onClick={() => this.openDslr()} variant="contained">PAY</Button> */}

                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default List;
