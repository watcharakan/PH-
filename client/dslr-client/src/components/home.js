import React, { Component } from 'react'
import '../App.css';

export default class Home extends Component {
    render() {
        return (
            <div className="div-bg div-clickable" style={{ width: '100%', height: '100vh', display: 'flex', justifyContent: 'center', alignItems: 'center', backgroundColor: '#F1EBDC' }}
                onClick={() => this.navigateToList()}
            >
            </div>
        )
    }

    navigateToList = () => {
        window.location.replace('/list');
    }
}
