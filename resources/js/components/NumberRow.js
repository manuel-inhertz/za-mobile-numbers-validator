import React from 'react';

const NumberRow = (props) => {
    const correctness = props.correctness ? "Yes" : "No";
    return (
        <tr>
            <th scope="row">{props.id}</th>
            <td>{props.number}</td>
            <td>{correctness}</td>
            <td>{props.notes}</td>
        </tr>
    );
}

export default NumberRow;
