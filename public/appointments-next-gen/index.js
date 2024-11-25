import { List } from './components/views/list/index.js';
import { ReactDOM, html } from './deps.js';

const App = (props) => {
    const { date, hours, users } = props.config;

    console.log('App config:date', date);
    console.log('App config:hours', hours);
    console.log('App config:users', users);

    return html`<${List} date=${date} hours=${hours} users=${users} />`;
};

ReactDOM.render(
    html`<${App} config=${window.appointmentProps} />`,
    document.getElementById('root'),
);
