import React from 'react';
import ReactDOM from 'react-dom';

import ListIdeas from './containers/ListIdeas/ListIdeas.js';
import Idea from './components/Idea/Idea.js';

const ListIdeasContainer = document.getElementById('listIdea');

const ideas = JSON.parse(ListIdeasContainer.getAttribute('data-ideas'));
const voted_ideas = JSON.parse(ListIdeasContainer.getAttribute('data-voted-ideas'));
const isAdmin = ListIdeasContainer.getAttribute('data-is-admin');

ReactDOM.render(<ListIdeas ideas={ideas} voted_ideas={voted_ideas} isAdmin={isAdmin} />, document.getElementById('listIdea'));