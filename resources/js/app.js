
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

window.Vue = require('vue')

const app = new Vue({
  el: '#app',
  data: {
    steps: [
      {name: 'hello', completion: false},
      {name: 'world', completion: false},
      {name: '1', completion: false},
      {name: '2', completion: true},
    ],
    newStep: ''
  },
  computed: {
    inProcess () {
      return this.steps.filter((step) => {
        return !step.completion
      })
    },
    processed () {
      return this.steps.filter((step) => {
        return step.completion
      })
    }
  },
  methods: {
    addStep () {
      this.steps.push({name: this.newStep, completion: false})
      this.newStep = ''
    },
    toggle (step) {
      step.completion = !step.completion
    },
    remove (step) {
      let i = this.steps.indexOf(step)
      this.steps.splice(i, 1)
    },
    edit (step) {
      // 删除当前step
      this.remove(step)
      // 在输入框显示当前step的name
      this.newStep = step, name
      // focus 当前输入框
      this.$refs.newStep.focus()
    },
    completeAll () {
      this.inProcess.forEach((step) => {
        step.completion = true
      })
    },
    clearCompleted() {
      this.steps = this.inProcess
    }
  }
})