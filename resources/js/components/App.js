import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import { Layout } from './modules/'

export default class App extends Component {
  render() {
    return (
      <Fragment>
        <Layout />
      </Fragment>
    );
  }
}

if (document.getElementById('example')) {
    ReactDOM.render(<App />, document.getElementById('example'));
}