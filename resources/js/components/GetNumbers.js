import React from 'react';
import NumberRow from './NumberRow';

const GetNumbers = (props) => {
    return (
    <div id="getNumbersComponent" className="col-12">
        <table className="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Number</th>
                    <th scope="col">Correctness</th>
                    <th scope="col">Notes</th>
                </tr>
            </thead>
            <tbody>
                {
                    Object.keys(props.numbers).map((number) => {
                            return (
                                <NumberRow
                                    id={props.numbers[number].id}
                                    number={props.numbers[number].number}
                                    correctness={
                                        props.numbers[number].correctness
                                    }
                                    notes={props.numbers[number].notes}
                                    key={props.numbers[number].id}
                                />
                            );
                    })
                }
            </tbody>
        </table>
    </div>
    );
}

export default GetNumbers;
