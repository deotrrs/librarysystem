import React from 'react';

const CardItem = (props) => (
    
    <div className="col-12 col-md-4 col-sm-6 col-lg-4 col-xl-3 py-lg-3 pb-5">
        <div className="card">
            <div className="item_image">
                <img className="card-img-top img-fluid" src={"http://localhost:8000/storage/images/books/"+props.data.image_path} alt="Book Image" />
            </div>
            <div className="card-block">
                <div className="card-title">                    
                    <h5>{props.data.title}</h5>
                </div>
                <ul className="list-group list-group-flush">
                    <li className="list-group-item"><b>Author:</b> {props.data.author}</li>
                    <li className="list-group-item"><b>Published by:</b> {props.data.publisher}</li>
                    <li className="list-group-item"><b>Year published:</b> {props.data.year}</li>
                    <li className="list-group-item"><b>Category:</b> {props.data.category.name}</li>
                </ul>
            </div>
        </div>
    </div>
);
export default CardItem;