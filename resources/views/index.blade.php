@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tags</div>

                <div class="card-body">
                    <tag-form v-on:add-tag="addTag($event)"></tag-form>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-wrap">
                            <div class="card py-2 px-3 mr-1" v-for="(tag, index) in tags" :key="tag.id">
                                <div class="d-flex align-items-center">
                                    <span>
                                        @{{ tag.body }}
                                    </span>

                                    <img src="/svg/close.svg" alt="delete" class="ml-1 p-1" @click="delTag(index)" style="height: 15px">
                                </div>
                            </div>
                        </div>

                        <div>
                            <button v-show="tags.length > 0" class="btn mt-2" @click="makeQuery">Procurar mensagens recentes (2segs)</button>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="mt-3 text-center">Ultimas mensagens pesquisadas...</h2>
            <twitter-post v-for="(message, index) in messages" :key="message.id" :postid="message.id" :name="message.name" :body="message.body" :link="message.link" :index="index" v-on:del-post="delPost($event)"></twitter-post>

        </div>
    </div>
</div>
@endsection