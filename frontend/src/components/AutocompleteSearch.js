import React, { Component } from 'react'
import axios from 'axios'
import SuggestionList from './SuggestionList'

const API_URL = 'http://127.0.0.1:8081/api/v1/state/search'

class AutocompleteSearch extends Component {
    state = {
        query: '',
        results: []
    }

    getInfo = () => {
        axios.get(`${API_URL}?term=${this.state.query}`)
            .then(({ data }) => {
                this.setState({
                    results: data // MusicGraph returns an object named data,
                                       // as does axios. So... data.data
                })
            })
    }

    handleInputChange = () => {
        this.setState({
            query: this.search.value
        }, () => {
            if (this.state.query && this.state.query.length > 1) {
                if (this.state.query.length % 2 === 0) {
                    this.getInfo()
                }
            }
        })
    }

    render() {
        return (
            <form>
                <input
                    placeholder="Search for..."
                    ref={input => this.search = input}
                    onChange={this.handleInputChange}
                />
                <SuggestionList results={this.state.results} />
            </form>
        )
    }
}

export default AutocompleteSearch