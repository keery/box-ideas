import React, { Component } from 'react'

import './ListIdeas.css'
import Idea from '../../components/Idea/Idea.js'

class ListIdeas extends Component {

    
    constructor(props) {
        super(props)

        this.state = { ideas: props.ideas }
    }


    
    render() {
        const { ideas } = this.state;
        // ideas.map(({author, title, description}) => {
        //     console.log(author)
        // });
        return (
            <div>
                <div></div>
                <ul className="list-group">
                    {
                        ideas.map(({id, author, title, description}) => (
                            <li key={'li_idea_'+id} className="list-group-item">
                                <Idea author={author} title={title} description={description} key={id} />
                            </li>
                        ))
                    }
                </ul>
            </div>
            
        )
    }
}

// ListIdeas.propTypes = {
//     ideas: PropTypes.array.isRequired,
// }

export default ListIdeas