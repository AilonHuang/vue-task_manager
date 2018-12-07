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

      <div class="card">
        <div class="card-header">
          <div class="form-group">
            <label v-if="!newStep">要完成当前任务，需要哪些步骤？</label>
            <input type="text" v-model="newStep" ref="newStep" @keyup.enter="addStep"
                   class="form-control">
          </div>

          <button class="btn btn-sm btn-success pull-right" v-if="newStep" @click="addStep">添加步骤</button>
        </div>
      </div>
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
  export default {
    props: {
      route: String
    },
    data () {
      return {
        steps: [
          // {name: '', completion: false},
        ],
        newStep: ''
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
      addStep () {
        axios.post(this.route, {name: this.newStep}).then((res) => {
          this.steps.push(res.data.step)
          this.newStep = ''

        }).catch((err) => {

        })
        // this.steps.push({name: this.newStep, completion: false})
        // this.newStep = ''
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
          this.newStep = step.name
          // focus 当前输入框
          this.$refs.newStep.focus()
        })
      },
      completeAll () {
        this.inProcess.forEach((step) => {
          step.completion = true
        })
      },
      clearCompleted () {
        this.steps = this.inProcess
      }
    }
  }
</script>

<style>

</style>