import React from 'react';
import ReactDOM from 'react-dom';
import GetNumbers from './GetNumbers';
import Axios from 'axios';
import CheckNumber from './CheckNumber';

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            numbers: null,
            verifyNumber: {
                number: null,
                submitting: false,
                isCorrect: false,
                notes: ''
            }
        };
    }

    componentDidMount = () => {
        console.log('Main component has mounted');
        this.getNumbers();
    }

    // Handle numbers api request
    getNumbers = () => {
        Axios.get('/api/numbers')
        .then((res) => {
            this.setState({ numbers: res.data });
        })
        .catch(err => {
            console.log(err);
            return err;
        });
    }

    inputChangeHandler = (e) => {
        this.setState({
            verifyNumber: {
                number: e.target.value,
                notes: ''
            }
        });
    }

    submitHandler = (e) => {
        e.preventDefault();
        this.setState({ verifyNumber: { submitting: true } });
        Axios.get(`/api/numbers/verify/${this.state.verifyNumber.number}`)
        .then((res) => {
            this.setState({
                verifyNumber: {
                    submitting: false,
                    isCorrect: res.data["is_correct"],
                    notes: res.data.notes
                }
            });
        })
        .catch(err => {
            console.log(err);
            this.setState({
                verifyNumber: {
                    submitting: false,
                    notes: err
                }
            })
        });
    }

    // Render
    render() {
        const numbers = (this.state.numbers) ? <GetNumbers numbers={this.state.numbers} /> : null;
        return (
            <div className="row">
                <CheckNumber
                    onChange={this.inputChangeHandler}
                    onSubmit={this.submitHandler}
                    classes="mb-5 col-md-4 offset-md-4"
                    isCorrect={this.state.verifyNumber.isCorrect}
                    notes={this.state.verifyNumber.notes}
                />
                {numbers}
            </div>
        );
    }
}

export default App;

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
