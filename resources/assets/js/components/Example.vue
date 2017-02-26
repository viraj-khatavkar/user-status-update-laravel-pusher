<template>
    <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Status - {{ friend.status }}
                    <div class="btn-group pull-right">
                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </div>
                </div>
            <div class="panel-collapse collapse" id="collapseOne">
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">{{ this.user2.name }}</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font">{{ this.user.name }}</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." @keyup="whisper()" />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat">
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Panel heading without title</div>
                    <div class="panel-body">
                    Panel content
                    </div>
            </div>
        </div> -->
    </div>
</div>
</template>

<script>
    export default {
        props: ['user', 'user2'],
        data() {
            return {
                friend: this.user2
            }
        },
        mounted() {
            this.listen();
            this.listenForWhisper();
        },
        methods: {
            listen() {
                Echo.join('chat')
                    .joining((user) => {
                        axios.put('/api/user/'+ user.id +'/online?api_token=' + user.api_token, {});
                    })
                    .leaving((user) => {
                        axios.put('/api/user/'+ user.id +'/offline?api_token=' + user.api_token, {});
                    })
                    .listen('UserOnline', (e) => {
                        this.friend = e.user;
                    })
                    .listen('UserOffline', (e) => {
                        this.friend = e.user;
                    });
            },
            whisper() {
                Echo.join('chat')
                    .whisper('typing', {
                        name: this.user.name
                    });
            },
            listenForWhisper() {
                Echo.join('chat')
                    .listenForWhisper('typing', (e) => {
                        this.friend.status = e.name + " is typing";
                    });
            }
        }
    }
</script>
