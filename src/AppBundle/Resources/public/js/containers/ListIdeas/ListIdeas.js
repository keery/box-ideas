import React, { Component } from 'react'
import PropTypes from 'prop-types';
import './ListIdeas.css'
import Idea from '../../components/Idea/Idea.js'
import throttle from 'lodash.throttle'


class ListIdeas extends Component {

    
    constructor(props) {
        super(props)

        this.state = { 
            ideas: props.ideas,
            voted_ideas: props.voted_ideas
        }
    }
    
    render() {
        const { ideas, voted_ideas } = this.state;

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
                                    nbVote={votes.length}
                                    voted={ id in voted_ideas ? true : false }
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
    ideas: PropTypes.array.isRequired,
    voted_ideas: PropTypes.array.isRequired
}

export default ListIdeas