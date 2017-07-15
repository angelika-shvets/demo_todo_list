/**
 * Created by angelika on 7/14/17.
 */

var TodoList = React.createClass({
    getInitialState: function () {
        return {
            todo_list: []
        };
    },

    _getTodoList: function () {
        $.get('/tasks', function (data) {
            this.setState({todo_list: data});
        }.bind(this));
    },
    render: function () {
        var handleTodoList = this.state.todo_list.map(function (row) {
            return <TodoListCRUD key={row.id} id={row.id} content={row.content} completed={row.completed}/>
        });

        return (
            <div>
                <HeaderBlock />
                {this._getTodoList()}
                {handleTodoList}
                <AddNewTask />
            </div>
        );
    }
});

class HeaderBlock extends React.Component {
    render() {
        return (
            <div  className = 'header_block'>
                <h1>Todo List</h1>
            </div>
        );
    }
}
var AddNewTask = React.createClass({
    _handleClick: function () {
        var new_todo_row = this.refs.todo_list.value;
        $.post('/tasks', {content: new_todo_row}, function (data) {
            console.log(data);
        });
    },
    render: function () {
        return (
            <div>
                <input type="text" className="add_new_task_input" placeholder="ADD Task" ref="todo_list"/>
                <input type="button"  className="add_new_task_button" value="Add New Tasks" onClick={this._handleClick}/>
            </div>
        );
    }
});
var TodoListCRUD = React.createClass({
    getInitialState: function () {
        return {
            value: ''
        };
    },
    _changeCheckbox : function ()  {

        var todo_checked = this.refs.check_box.checked;

        todo_checked ?  todo_checked=1: todo_checked=0;

        $.post('/tasks/'+this.props.id, { completed: todo_checked});

    },
    _removeRow: function () {
        console.log(this.props.id);
        $.post('/delete', {id: this.props.id}, function (data) {
            console.log(data);
        });
    },
    _editRow(event) {
        this.setState({value: event.target.value});
        if(this.props.content != event.target.value){
            var todo_edit = event.target.value;
            console.log(todo_edit);
            $.post('/tasks/'+this.props.id, { content: todo_edit});
        }
    },
    render: function () {
        return (
            <div>
                <li className = 'list_row' id={this.props.id}>
                    <input type="checkbox"
                        onChange={this._changeCheckbox}
                        checked={this.props.completed ?'checked': '' } 
                        defaultChecked={this.props.completed}
                        ref="check_box"
                    />
                    <input
                        className ={this.props.completed ?'completed text_part': 'text_part' }
                        type="text"
                        onChange={this._editRow}
                        defaultValue={this.props.content }
                    />
                    <button className = 'remove_row' onClick={this._removeRow}> x</button>
                </li>

            </div>

        );
    }
});
ReactDOM.render(
    <TodoList />,
    document.getElementById('list_content')
);

 