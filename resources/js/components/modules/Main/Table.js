import React,{Component} from 'react';
import {TableItem} from './index'
class Table extends Component{
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
    render(){
        var { books } = this.state;
        return(
            <div className="col-md-12 pt-2">
                <div className="app header">
                    <h1>Published Books</h1>
                </div> 
                <div className="app add-button">
                    <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        Add new Book
                    </button> 
                </div>                      
                <table className="table table-condensed table-bordered" id="bookTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Book Title</th>
                            <th>ISBN</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Year published</th>
                            <th>Category</th>
                            <th>Date Added</th>
                            <th>Date Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    {books.map((item, i) => <TableItem data={item} key={i}/>)}
                    </tbody>                 
                </table>
            </div>  
        );
    }
}
export default Table;