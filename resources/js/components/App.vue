<template>
  <div class="app">
    <div class="container">
      <div class="row header">
        <h1 class="col s6 offset-s3 center-align teal-text">To-Do List!</h1>
      </div>
      <div class="row">
        <form @submit.prevent="submitTodo" class="col s6 offset-s3">
          <div class="input-field">
            <i class="material-icons prefix">list</i>
            <textarea ref="newTodoBox" v-model="newTodo" id="icon_prefix2" class="materialize-textarea"></textarea>
            <label for="icon_prefix2">What to do?</label>
          </div>
          <button class="btn waves-effect col s12">{{ btn }}</button>
        </form>
      </div>
      <div class="row">
        <ul class="collection col s6 offset-s3">
          <li class="collection-item" v-for="todo in todos" :key="todo.id">            
            <p v-if="todo.editing">
              <textarea v-model="todo.title" class="materialize-textarea" ></textarea>
            </p>
            <p v-else>
              <label>
                <input type="checkbox" :checked=todo.completed @change="toggleTodo(todo)" />              
                <span>{{todo.title}}</span>
                <span>                  
                  <a @click.prevent="deleteTodo(todo)">
                    <i class="material-icons right teal-text">delete</i>
                  </a>
                  <a @click.prevent="editTodo(todo)">
                    <i class="material-icons right teal-text">edit</i>
                  </a>
                </span>
              </label>
            </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'app',
  data() {
    return {
      todos: [],
      newTodo: '',
      btn: 'ADD',
    };
  },
  mounted() {
    let vm = this;
    axios.get('/api/todo').then(function (response) {
      vm.todos = response.data.data;
    }).catch(function (error) {
      console.log(error)
    })
  },
  methods: {
    submitTodo() {
      let vm = this;

      if(vm.btn == "SAVE" && vm.edit) {
        axios.put('/api/todo/' + vm.edit.id, { "title": this.newTodo, "completed": vm.edit.completed }).then(function (response) {        
          let updated = response.data.data;
          vm.edit.title = updated.title;
          vm.edit = null;
          vm.btn = "ADD";
          vm.newTodo = '';
        }).catch(function (error) {
          console.log(error)
        })        
      } else if(vm.btn == "ADD") {
        axios.post('/api/todo', { "title": this.newTodo }).then(function (response) {        
          vm.todos.push(response.data.data);
          vm.newTodo = '';
        }).catch(function (error) {
          console.log(error)
        })
      }
    },
    editTodo(todo) { 
      this.newTodo = todo.title;
      this.edit = todo;
      this.btn = "SAVE";
      this.$refs.newTodoBox.focus();      
    },
    toggleTodo(todo) {      
      todo.completed = !todo.completed
      axios.put('/api/todo/' + todo.id, { "title": todo.title, "completed": todo.completed }).then(function (response) {        
        let updated = response.data.data;
        todo.completed = updated.completed;
      }).catch(function (error) {
        console.log(error)
      })
    },
    deleteTodo(todo) {
      let vm = this;
      axios.delete('/api/todo/' + todo.id).then(function (response) {
        const todoIndex = vm.todos.indexOf(todo);
        vm.todos.splice(todoIndex, 1);
      }).catch(function (error) {
        console.log(error)
      })
    },
  },

};
</script>

<style lang="scss">
.header{
  margin-top: 100px;
}
.edit {
  display: none;
}
</style>
