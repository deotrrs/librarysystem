import React, { Component } from 'react';
import { CardItem } from './index';
import { Card } from './index';
class Main extends Component {
    constructor(props) {
        super(props);

        this.state = {
            books: []
        }
    }
    componentDidMount() {
        fetch('/api/items')
            .then(response => {
                return response.json();
            })
            .then(books => {
                this.setState({ books });
            });
    }
    render () {
        var { books } = this.state;
        return (
          <div>
            <div className="container">
              <div className="row">
                {books.map((item, i) => <CardItem data={item} key={i}/>)}
              </div>
            </div>
          </div>
        )
      }
}
export default Main;
