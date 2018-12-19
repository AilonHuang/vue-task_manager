<template>
  <div class="row justify-content-center">
    <div class="col-4 mr-3">
      <div class="card mb-4" v-if="inProcess.length">
        <div class="card-header">
          待完成的步骤（{{ inProcess.length }}）:
          <button class="btn btn-sm btn-success pull-right" @click="completeAll">完成所有</button>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item" v-for="step in inProcess">
              <span @dblclick="edit(step)">{{ step.name }}</span>
              <span class="pull-right">
                <i class="fa fa-check" @click="toggle(step)"></i>
                <i class="fa fa-close" @click="remove(step)"></i>
              </span>
            </li>
          </ul>
        </div>
      </div>

      <step-input :route="route" @add="sync"></step-input>
    </div>

    <div class="col-4">
      <div class="card" v-show="processed.length">
        <div class="card-header">已完成步骤（{{ processed.length }}）:
          <button class="btn btn-sm btn-danger pull-right" @click="clearCompleted">清除已完成</button>
        </div>

        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item" v-for="step in processed">
              <span @dblclick="edit(step)">{{ step.name }}</span>
              <span class="pull-right">
                <i class="fa fa-check" @click="toggle(step)"></i>
                <i class="fa fa-close" @click="remove(step)"></i>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  import StepInput from './step-input'
  import {Hub} from '../event-bus'
  export default {
    props: {
      route: String
    },
    components: {
        StepInput
    },
    data () {
      return {
        steps: [
          // {name: '', completion: false},
        ],
      }
    },
    created () {
      this.fetchSteps()
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
      fetchSteps () {
        axios.get(this.route).then((res) => {
          this.steps = res.data.steps
        }).catch((err) => {

        })
      },
      sync (step) {
          this.steps.push(step)
      },
      toggle (step) {
        axios.patch(`${this.route}/${step.id}`, {completion: !step.completion}).then((res) => {
          step.completion = !step.completion
        }).catch((err) => {

        })
      },
      remove (step, success) {
        axios.delete(`${this.route}/${step.id}`).then((res) => {
          let i = this.steps.indexOf(step)
          this.steps.splice(i, 1)
          success && success()
        }).catch((err) => {

        })
      },
      edit (step) {
        // 删除当前step
        this.remove(step, () => {
          // 在输入框显示当前step的name
          Hub.$emit('edit', step)
        })
      },
      completeAll () {
        axios.post(`${this.route}/complete`).then((res) => {
          this.inProcess.forEach((step) => {
            step.completion = true
          })
        }).catch((err) => {

        })
      },
      clearCompleted () {
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