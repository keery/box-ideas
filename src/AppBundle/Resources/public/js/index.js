import React from 'react';
import ReactDOM from 'react-dom';

import ListIdeas from './containers/ListIdeas/ListIdeas.js';
import Idea from './components/Idea/Idea.js';

const ListIdeasContainer = document.getElementById('listIdea');

const ideas = JSON.parse(ListIdeasContainer.getAttribute('data-ideas'));


// const getData = (name, json = true) => {
//     const value = TodoListElement.getAttribute(`data-${name}`);
//     return json ? JSON.parse(value) : value;
// };

// // const element = React.createElement(Idea, {
// //     items: getData(items),
// // });

ReactDOM.render(<ListIdeas ideas={ideas} />, document.getElementById('listIdea'));

console.log("duhfdjf");