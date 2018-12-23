<template>
  <div class="card mb-4" v-if="steps.length">
    <!--<div class="card-header">-->
      <!--待完成的步骤（{{ steps.length }}）:-->
      <!--<button class="btn btn-sm btn-success pull-right" @click="completeAll">完成所有</button>-->
    <!--</div>-->
    <div class="card-body">
      <ul class="list-group">
        <li class="list-group-item" v-for="step in steps">
          <span @dblclick="edit(step)">{{ step.name }}</span>
          <span class="pull-right">
            <i class="fa fa-check" @click="toggle(step)"></i>
            <i class="fa fa-close" @click="remove(step)"></i>
          </span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  import {Hub} from '../event-bus'

  export default {
    props: {
      steps: Array,
      route: String,
    },
    methods: {
      toggle(step) {
        console.log(step)
        axios.patch(`${this.route}/${step.id}`, {completion: !step.completion}).then((res) => {
          step.completion = !step.completion
        }).catch((err) => {

        })
      },
      remove(step, success) {
        axios.delete(`${this.route}/${step.id}`).then((res) => {
          Hub.$emit('remove', step)
          success && success()
        })
      },
      edit(step) {
        // 删除当前step
        this.remove(step, () => {
          console.log('step')
          // 在输入框显示当前step的name
          Hub.$emit('edit', step)
        })
      },
    }
  }
</script>