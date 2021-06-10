import React from 'react';
import './App.css';
import AutocompleteSearch from './components/AutocompleteSearch'
function App() {
    return (
        <div className="App">
            <div className="auto-complete-box">

                <div className="auto-complete-inner">
                    <h1>Schoology Autosearch</h1>
                    <AutocompleteSearch/>
                </div>
            </div>
        </div>
    );
}

export default App;