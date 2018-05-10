import React from 'react'
import './Idea.css'


const Idea = ({ title, author, description }) => (
    <div className="Idea row">
        <div className="col-xs-1 text-center">
            <button className="btn" type="button" title="Upvote">+</button>
        </div>
        <div className="col-xs-11">
            <div className="title-idea">{ title }</div>
            <div className="author-idea">By {author}</div>
            <div className="desc-idea">{ description }</div>
        </div>
    </div>
)

export default Idea