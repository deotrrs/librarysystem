import React from 'react';

const TableItem = (props) => (

    <tr>
        <td>
            <div className="table item_image">
                <img src="" alt="published books" />
            </div>
        </td>
        <td>{props.data.title}</td>
        <td>{props.data.isbn}</td>
        <td>{props.data.author}</td>
        <td>{props.data.publisher}</td>
        <td>{props.data.year}</td>
        <td>{props.data.category.name}</td>
        <td>{props.data.created_at}</td>
        <td>{props.data.updated_at}</td>
        <td>
            <button className="btn btn-block btn-info" data-toggle="modal" data-target="#editModal" onclick="">Edit</button>
            <button type="button" id="deletebtn" className="btn btn-block btn-danger" onclick="remove({{$b->id}})">Delete</button>
        </td>
    </tr>

);

export default TableItem;