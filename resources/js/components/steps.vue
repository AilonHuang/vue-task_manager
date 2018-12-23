<template>
  <div class="row justify-content-center">
    <div class="col-4 mr-3">
      <step-list :route="route" :steps="todos">
        <div class="card-header">
          待完成的步骤（{{ todos.length }}）:
          <button class="btn btn-sm btn-success pull-right" @click="completeAll">完成所有</button>
        </div>
      </step-list>
      <step-input :route="route"></step-input>
    </div>

    <div class="col-4">
      <step-list :route="route" :steps="dones">
        <div class="card-header">已完成步骤（{{ dones.length }}）:
          <button class="btn btn-sm btn-danger pull-right" @click="clearCompleted">清除已完成</button>
        </div>
      </step-list>
    </div>
  </div>
</template>

<script>
  import StepInput from './step-input'
  import StepList from './step-list'

  export default {
    props: {
      route: String,
      initialSteps: Array,
      todos: Array,
      dones: Array,
    },
    components: {
      StepInput,
      StepList
    },
    data() {
      return {
        steps: this.initialSteps,
      }
    },
    methods: {
      remove(step) {
        let i = this.steps.indexOf(step)
        this.steps.splice(i, 1)
      },
      completeAll() {
        axios.post(`${this.route}/complete`).then((res) => {
          window.location.reload()
        }).catch((err) => {

        })
      },
      clearCompleted() {
        axios.delete(`${this.route}/clear`).then((res) => {
          window.location.reload()
        }).catch((err) => {

        })
      }
    }
  }
</script>

<style>

</style>