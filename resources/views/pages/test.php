<?php
/**
 * Created by PhpStorm.
 * User: Kaspars
 * Date: 4/5/2018
 * Time: 21:31
 */

?>

<div class="row justify-content-center">
    <div class="col-sm-7 col-xs-12">
        <div id="question-container" class="jumbotron">
            <div class="question--loading">
                <div class="row">
                    <div class="col-12">
                        <div class="display-4">
                            <h4 class="text-center">We are loading your test!</h4>
                        </div>
                    </div>
                    <div class="col-12 align-self-center">
                        <h1 class="text-center"><i class="fas fa-spinner fa-spin"></i></h1>
                    </div>
                </div>
            </div>
            <div class="question--box">
                <div class="display-4">
                    <h1 class="question--box__question">{{ currentQuestion["question_name"] }}</h1>
                </div>
                <hr class="my-2">
                <div class="row justify-content-center">
                    <div class="col-sm-10 col-xs-12">
                        <div class="row justify-content-start">
                            <div v-for="answers in currentAnswers" class="col-sm-6 col-xs-12">
                                <div class="jumbotron  answer-box" @click="chooseAnswer(answers['answer_correct'])">
                                    <h4 class="text-center">{{ answers["answer_text"] }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="progress-bar-holder">
                                    <p class="text-center">Your progress {{ current+1 }} of {{ total }}</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="small-footer">
                    <p>Powered by <i class="fab fa-first-order"></i></p>
                </div>
            </div>
            <div class="question--final-box">
                <div class="row">
                    <div class="col-12">
                        <div class="display-4">
                            <p class="text-center">Congratulations, <?=$response["params"]["user"]["user_name"]?> !</p>
                        </div>
                    </div>
                    <hr class="my-2">
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h4 class="text-center">Your score: {{ correct }} of {{ total }}</h4>
                        <p class="text-center"><em>Share LINK with your friends! So they know how smart you are!</em></p>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <a href="/" class="btn btn-custom btn-default btn-raised">Try again!</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js"></script>
<script type="text/javascript">


    /**
     * Using amazing VUE but should store questions in session or call each question separate
     * because at the moment I can see everything!
     *
     * @type {Vue}
     */

    var myVue = new Vue({
        el: "#question-container",
        data: {
            "total": <?=$response["params"]["user"]["test_length"]?>,
            "current": <?=$response["params"]["user"]["current_question"]?>,
            "correct": <?=$response["params"]["user"]["correct_answers"]?>,
            "questions": [],
            "currentQuestion": "",
            "currentAnswers": []
        },
        methods: {
            fetchQuestions: function(){

                var self = this;

                if(self.total == self.current) {
                    self.allDone();
                    return;
                }

                $.getJSON("/questions", {"test_id": "<?=$response["params"]["user"]["test_id"]?>"}, function(r){
                   //console.log(r);

                   self.questions = r;
                   self.selectQuestion(self.current);
                   //console.log(self.currentAnswers);

                   self.showQuestions();
                   self.setProgress();
                });

            },
            chooseAnswer: function(i) {
                /* TODO: add some loader while changing questions? */
                var self = this;

                $.ajax({
                    url: "/answer",
                    type: "POST",
                    data: {"user_id":<?=$response["params"]["user"]["user_id"]?>, "answer": i, "correct": self.correct, "current":  self.current},
                    success: function(r) {
                        var resp = JSON.parse(r);

                        if(resp["success"]) {
                            self.current = resp["current"];
                            self.correct = resp["correct"];

                            self.selectQuestion(self.current);
                        } else {
                            alert(resp["message"]);
                        }
                      //  if(r == )
                       // self.selectQuestion(self.current);
                    },
                    fail: function(r){
                        console.log(r);
                    }
                });
            },
            allDone: function (){
               //alert("all done bitches");
                $(".question--loading").fadeOut();
                $(".question--box").fadeOut();

                setTimeout(function(){ $(".question--final-box").fadeIn();},1000)
            },
            showQuestions: function(){
                var l = $(".question--loading");
                var q = $(".question--box");

                l.fadeOut();
                setTimeout(function(){ q.fadeIn()},1000)
            },
            selectQuestion: function(i) {
                var self = this;

                if(i >= self.total) {
                    self.allDone();
                    return;
                }

                self.currentQuestion = self.questions[i];
                self.currentAnswers = self.questions[i]["answers"];

                self.setProgress();
            },
            setProgress: function() {
                var progresBar = $(".progress-bar");
                var actualProgress = Math.round((this.current / this.total) * 100);

                progresBar.css("width", actualProgress+"%");
            }
        },
        mounted: function(){
            this.$nextTick(function(){
                myVue.fetchQuestions();
            });
        }
    })


</script>