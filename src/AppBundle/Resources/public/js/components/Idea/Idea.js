import React, { Component } from 'react'
import './Idea.css'
import throttle from 'lodash.throttle'


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
            value: (props.voted ? "Unvote" : "Upvote")
        }
    }
    

    //Action lors du clique du bouton d'une idée
    handleVote(index) {
        
        const {voted} = this.state;
        
        if(voted) this.setState( {voted : false, nbVote: this.state.nbVote-1, value:"Upvote", votable: false});
        else this.setState( {voted : true, nbVote: this.state.nbVote+1, value: "Unvote", votable: false})
        
        const config = { 
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({idIdea: index})
        };

        fetch('ajax/upvote', config)
        .then((response) => {            
            this.setState( {votable: true })
        });
    }

    render() {

        const { id, title, author, description, votable, voted, nbVote, value } = this.state;
        return (
            <div className="Idea row">
                <div className="col-sm-1 col-xs-2 text-center">
                    <button className={voted ? "btn btn-danger" : "btn btn-success"} disabled={!votable} type="button" title={value} onClick={votable ? () => this.handleVote(id) : () => {} }>{value}</button>
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
    voted : PropTypes.bool.isRequired
}

export default Idea