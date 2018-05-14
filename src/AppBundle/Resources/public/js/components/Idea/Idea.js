import React, { Component } from 'react'
import './Idea.css'
import PropTypes from 'prop-types';

class Idea extends Component {

    
    constructor(props) {
        super(props)

        this.state = { 
            id: props.id,
            title: props.title,
            author: props.author,
            description: props.description,
            //Boolean autorisant l'action de voter
            votable: true,
            //Boolean indiquant si nous avons déjà voté pour cette idée
            voted: props.voted,
            //nombre total de vote
            nbVote: props.nbVote,
            isAdmin: props.isAdmin,
            //Fonction du container List idea pour supprimer l'idée
            deleteFunc: props.deleteFunc,
            value: (props.voted ? "Unvote" : "Upvote")
        }
    }
    

    //Action lors du clique du bouton d'une idée
    handleVote(index) {
        
        const {voted} = this.state;
        
        if(voted) this.setState( {voted : false, nbVote: this.state.nbVote-1, value:"Upvote", votable: false});
        else this.setState( {voted : true, nbVote: this.state.nbVote+1, value: "Unvote", votable: false})
        
        const config = { 
            method: 'GET',
            headers: {'Content-Type': 'application/json'}
        };

        fetch('ajax/upvote/'+index, config)
        .then((response) => {            
            this.setState( {votable: true })
        })
        .catch(error => console.warn(error));
    }

    render() {

        const { id, title, author, description, votable, voted, nbVote, value, deleteFunc, isAdmin } = this.state;
        return (
            <div className="Idea row">
                <div className="col-sm-1 col-xs-2 text-center">
                    <button className={voted ? "btn btn-danger" : "btn btn-success"} disabled={!votable} type="button" title={value} onClick={votable ? () => this.handleVote(id) : () => {} }>{value}</button>
                    { isAdmin &&
                        <button className="btn btn-danger spacing-v" onClick={() => deleteFunc(id)} >Delete</button>
                    }
                </div>
                <div className="col-sm-11 col-xs-10">
                    <div className="title-idea">{ title }</div>
                    <div className="author-idea">{ nbVote } vote(s) - By {author}</div>
                    <div className="desc-idea">{ description }</div>
                </div>
            </div>
        )
    }
}

Idea.propTypes = {
    id: PropTypes.number.isRequired,
    title: PropTypes.string.isRequired,
    author: PropTypes.string.isRequired,
    description: PropTypes.string.isRequired,
    nbVote: PropTypes.number.isRequired,
    voted : PropTypes.bool.isRequired,
    isAdmin : PropTypes.bool
}

export default Idea