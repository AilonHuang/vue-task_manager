@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <h3>{{$task->name}}</h3>
        <div class="row justify-content-center">
            <div class="col-4 mr-3">
                <div class="card mb-4" v-if="inProcess.length">
                    <div class="card-header">
                        待完成的步骤（@{{ inProcess.length }}）:
                        <button class="btn btn-sm btn-success pull-right" @click="completeAll">完成所有</button>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="(step, index) in inProcess">
                                <span @dblclick="edit(step)">@{{ step.name }}</span>
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
                    <div class="card-header">已完成步骤（@{{ processed.length }}）:
                        <button class="btn btn-sm btn-danger pull-right" @click="clearCompleted">清除已完成</button>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="(step, index) in processed">
                                <span @dblclick="edit(step)">@{{ step.name }}</span>
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
    </div>
@endsection