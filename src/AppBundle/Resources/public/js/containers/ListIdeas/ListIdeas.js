import React, { Component } from 'react'
import PropTypes from 'prop-types';
import './ListIdeas.css'
import Idea from '../../components/Idea/Idea.js'
import remove from 'lodash.remove'


class ListIdeas extends Component {

    constructor(props) {
        super(props)

        this.state = { 
            ideas: props.ideas,
            voted_ideas: props.voted_ideas,
            isAdmin: this.props.isAdmin === '1'
        }
        this.deleteIdea = this.deleteIdea.bind(this)
    }

    //Supprime une idée
    deleteIdea(id) {        
        const { ideas } = this.state;
        
        const config = { 
            method: 'GET',
            headers: {'Content-Type': 'application/json'}
        };

        fetch('ajax/delete/idea/'+id, config)
        .then((response) => {          
            remove(ideas, (el) => el.id == id )
            this.setState({ ideas: ideas });
        })
        .catch(error => console.warn(error));
    }
    
    render() {
        const { ideas, voted_ideas, isAdmin } = this.state;

        return (
            <div>
                <div></div>
                <ul className="list-group">
                    {
                        ideas.map(({id, author, title, description, votes}) => (
                            <li key={'li_idea_'+id} className="list-group-item">
                                <Idea 
                                    id={id} 
                                    author={author} 
                                    title={title} 
                                    description={description}  
                                    isAdmin={isAdmin}
                                    nbVote={votes.length}
                                    voted={ id in voted_ideas ? true : false }
                                    deleteFunc={this.deleteIdea}
                                />
                            </li>
                        ))
                    }
                </ul>
            </div>
            
        )
    }
}

ListIdeas.propTypes = {
    ideas: PropTypes.array.isRequired
}

export default ListIdeas