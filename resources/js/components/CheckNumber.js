import React from 'react';

const CheckNumber = (props) => {
    return(
        <div id="checkNumberComponent" className={props.classes}>
            <form onSubmit={props.onSubmit}>
                <div className="form-group">
                    <label for="number">Mobile Number</label>
                    <input onChange={props.onChange} type="text" className="form-control" id="number" />
                    <small id="numberHelp" className="form-text text-muted">API Endpoint: /numbers/verify/(number)</small>
                </div>
                <button type="submit" className="btn btn-primary" disabled={props.submitting}>{(props.submitting)? 'Submitting..' : 'Verify'}</button>
            </form>
            {(props.notes !== '') ? <div className={`mt-2 alert alert-${(props.isCorrect) ? 'success' :  'danger'}`}>{props.notes}</div> : null}
        </div>
    );
}

export default CheckNumber;
