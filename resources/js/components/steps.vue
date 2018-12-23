<template>
  <div class="row justify-content-center">
    <div class="col-4 mr-3">
      <step-list :route="route" :steps="inProcess">
        <div class="card-header">
          待完成的步骤（{{ inProcess.length }}）:
          <button class="btn btn-sm btn-success pull-right" @click="completeAll">完成所有</button>
        </div>
      </step-list>
      <step-input :route="route" @add="sync"></step-input>
    </div>

    <div class="col-4">
      <step-list :route="route" :steps="processed">
        <div class="card-header">已完成步骤（{{ processed.length }}）:
          <button class="btn btn-sm btn-danger pull-right" @click="clearCompleted">清除已完成</button>
        </div>
      </step-list>
    </div>
  </div>
</template>

<script>
  import StepInput from './step-input'
  import StepList from './step-list'
  import {Hub} from '../event-bus'

  export default {
    props: {
      route: String,
      initialSteps: Array,
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
    created() {
      Hub.$on('remove', this.remove)
    },
    computed: {
      inProcess() {
        return this.steps.filter((step) => {
          return !step.completion
        })
      },
      processed() {
        return this.steps.filter((step) => {
          return step.completion
        })
      }
    },
    methods: {
      sync(step) {
        this.steps.push(step)
      },
      remove(step) {
        let i = this.steps.indexOf(step)
        this.steps.splice(i, 1)
      },
      completeAll() {
        axios.post(`${this.route}/complete`).then((res) => {
          this.inProcess.forEach((step) => {
            step.completion = true
          })
        }).catch((err) => {

        })
      },
      clearCompleted() {
        axios.delete(`${this.route}/clear`).then((res) => {
          this.steps = this.inProcess
        }).catch((err) => {

        })
      }
    }
  }
</script>

<style>

</style>