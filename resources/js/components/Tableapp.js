import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import { Layouttable } from './modules/'

export default class Tableapp extends Component {
  render() {
    return (
      <Fragment>
        <Layouttable />
      </Fragment>
    );
  }
}
if (document.getElementById('react')) {
    ReactDOM.render(<Tableapp />, document.getElementById('react'));
}