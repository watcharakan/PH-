import './App.css';
import List from './components/list'
import Home from './components/home'
import { Routes, Route } from 'react-router-dom';
import { ScanQr } from './components';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <Routes>
          <Route path='/' element={<Home />} />
          <Route path='/list' element={<List />} />
          <Route path='/payment' element={<ScanQr />} />
        </Routes>
      </header>
    </div>
  );
}

export default App;
