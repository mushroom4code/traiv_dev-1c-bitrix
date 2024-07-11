<!--<h1>Рубрики блога</h1>-->
<?if ($arResult["ENGINE"] == 'Y'):?>
    <?php

$userID = $arResult["AR_USER"]["ID"];
$userName = $arResult["AR_USER"]["NAME"];
$userLastName = $arResult["AR_USER"]["LAST_NAME"];

$nobody = 0;


    \Bitrix\Main\UI\Extension::load("ui.vue");
    ?>
    <!-- Vue работает с этим div-ом -->
    <body>

    <!--container-->
    <section class="quiz-container">

        <!--questionBox-->
        <div class="questionBox" id="app">


            <!-- transition -->
            <transition :duration="{ enter: 500, leave: 300 }" enter-active-class="animated zoomIn" leave-active-class="animated zoomOut" mode="out-in">



                <!--qusetionContainer-->
                <div class="questionContainer" v-if="questionIndex<quiz.questions.length" v-bind:key="questionIndex">

                    <div class="quiz-startscreen" v-show="startscreen == 0" v-bind:key="startscreen">
                        <h2 class="quiz-start-title">
                            У нас есть еще кое-что интересное для вас...
                        </h2>
                        <span>
                            Насколько хорошо вы знаете крепёж?
                        </span>
                        <br>
                        <br>
                        <span>
                            Попробуйте свои силы в этой короткой викторине
                        </span>
                        <br>
                        <br>
                        <br>
                        <a class="quiz-button" @click="start()">Начать <i class="fa fa-refresh"></i></a>
                    </div>

                    <div v-show="startscreen == 1" v-bind:key="startscreen">


                    <header>
                        <h1 class="title is-6">ТрайвКвиз</h1>
                        <h3 class="title is-6">Участник: <?=$userName.' '.$userLastName.' ID:'.$userID?></h3>
                        <!--progress-->
                        <div class="progressContainer">
                            <progress class="progress is-info is-small" :value="(questionIndex/quiz.questions.length)*100" max="100">{{(questionIndex/quiz.questions.length)*100}}%</progress>
                            <p>{{(questionIndex/quiz.questions.length)*100}}% прогресс</p>
                        </div>
                        <!--/progress-->
                    </header>

                    <!-- questionTitle -->
                    <h2 class="titleContainer title">{{ quiz.questions[questionIndex].text }}</h2>

                    <!-- quizOptions -->
                    <div class="optionContainer">
                        <div class="option" v-for="(response, index) in quiz.questions[questionIndex].responses" @click="selectOption(index)" :class="{ 'is-selected': userResponses[questionIndex] == index}" :key="index">
                            {{ index | charIndex }}. {{ response.text }}
                        </div>
                    </div>

                    <!--quizFooter: navigation and progress-->
                    <footer class="questionFooter">

                        <!--pagination-->
                        <nav class="quiz-pagination" role="navigation" aria-label="pagination">

                            <!-- back button -->
                            <a class="quiz-button" v-on:click="prev();" :disabled="questionIndex < 1">
                                Назад
                            </a>

                            <!-- next button -->
                            <a class="quiz-button" :class="(userResponses[questionIndex]==null)?'':'is-active'" v-on:click="next();" :disabled="questionIndex>=quiz.questions.length">
                                {{ (userResponses[questionIndex]==null)?'Пропустить':'Следующий' }}
                            </a>

                        </nav>
                        <!--/pagination-->

                    </footer>
                    <!--/quizFooter-->

                    </div>

                </div>
                <!--/questionContainer-->

                <!--quizCompletedResult-->
                <div v-if="questionIndex >= quiz.questions.length" v-bind:key="questionIndex" class="quizCompleted has-text-centered">

                    <!-- quizCompletedIcon: Achievement Icon -->
                    <span class="icon">
                <i class="fa" :class="score()>3?'fa-check-circle is-active':'fa-times-circle'"></i>
              </span>

                    <!--resultTitleBlock-->
                    <h2 class="title">
                        Вы справились {{ (score()>7?'отлично!':(score()<4?'так себе =(':'неплохо')) }}
                    </h2>
                    <p class="subtitle">
                        Общий счёт: {{ score() }} / {{ quiz.questions.length }}
                    </p>
                    <br>
                    <p class="subtitle">
                        {{ ajaxResponse }}
                    </p>
                    <br>
                    <a class="quiz-button" @click="restart()">Заново <i class="fa fa-refresh"></i></a>
                    <!--/resultTitleBlock-->

                </div>
                <!--/quizCompetedResult-->

            </transition>

        </div>
        <!--/questionBox-->

    </section>
    <!--/container-->

    <!-- Load Vue script -->
    <script src="https://vuejs.org/js/vue.js"></script>
    <!-- On load, init Vue -->
    <script>

            // Create a quiz object with a title and two questions.
            // A question has one or more answer, and one or more is valid.
            var quiz = {
                //ajaxResponse: 'w',
                questions: [
                    {
                        text: "1. Каким конструктивным элементом болт отличается от винта?",
                        responses: [
                            {text: 'Наличием резьбы'},
                            {text: 'Наличием гайки', correct: true},
                        ]
                    }, {
                        text: "2. Какой отечественной марке стали соответствует марка стали А4?",
                        responses: [
                            {text: '10Х17Н13М2', correct: true},
                            {text: '08Х18Н10'},
                        ]
                    }, {
                        text: "3. Какая стопорная шайба максимально обеспечивает предохранение гайки от откручивания?",
                        responses: [
                            {text: 'Клиновая шайба', correct: true},
                            {text: 'Гроверная шайба'},
                        ]
                    }, {
                        text: "4. Укажите верную маркировку материала для изготовления полиамидного крепежа?",
                        responses: [
                            {text: 'ПА 10-СН-22'},
                            {text: 'ПА 6-СВ-30', correct: true},
                        ]
                    }, {
                        text: "5. Укажите верное количество существующих стопорных гаек по DIN?",
                        responses: [
                            {text: '9', correct: true},
                            {text: '11'},
                        ]
                    }, {
                        text: "6. Какое количество видов резьбовых соединений существует?",
                        responses: [
                            {text: '6', correct: true},
                            {text: '9'},
                        ]
                    }, {
                        text: "7. Какое количество заклепок используют при строительстве самолета Airbus A320?",
                        responses: [
                            {text: '7000 - 9000 шт'},
                            {text: '18000 - 20000 шт', correct: true},
                        ]
                    }, {
                        text: "8. Какой болт тяжелее: стальной, серебряный, медный?",
                        responses: [
                            {text: 'Стальной', correct: true},
                            {text: 'Серебряный'},
                            {text: 'Медный'},
                        ]
                    }, {
                        text: "9. В каком веке появился крепежный элемент БОЛТ?",
                        responses: [
                            {text: 'XIII'},
                            {text: 'XV', correct: true},
                        ]
                    }, {
                        text: "10. Из какого материала используют крепеж при строительстве комических кораблей?",
                        responses: [
                            {text: 'Платина'},
                            {text: 'Титан', correct: true},
                        ]
                    },
                ]
            },
                userResponseSkelaton = Array(quiz.questions.length).fill(null);

            BX.Vue.create({
                el: "#app",
                data: {
                    startscreen: 0,
                    quiz: quiz,
                    questionIndex: 0,
                    userResponses: userResponseSkelaton,
                    ajaxResponse: 'response error',
                    isPost: false
                },
                filters: {
                    charIndex: function(i) {
                        return String.fromCharCode(97 + i);
                    }
                },
                methods: {
                    restart: function(){
                        this.questionIndex=0;
                        this.userResponses=Array(this.quiz.questions.length).fill(null);
                    },
                    selectOption: function(index) {
                        Vue.set(this.userResponses, this.questionIndex, index);
                        //console.log(this.userResponses);
                    },
                    next: function() {
                        if (this.questionIndex < this.quiz.questions.length)
                            this.questionIndex++;
                    },

                    prev: function() {
                        if (this.quiz.questions.length > 0) this.questionIndex--;
                    },

                    start: function() {
                       console.log(this.parent);
                       this.startscreen++;
                    },

                    // Return "true" count in userResponses
                    score: function() {

                        var score = 0;
                        for (let i = 0; i < this.userResponses.length; i++) {
                            if (
                                typeof this.quiz.questions[i].responses[
                                    this.userResponses[i]
                                    ] !== "undefined" &&
                                this.quiz.questions[i].responses[this.userResponses[i]].correct
                            ) {
                                score = score + 1;
                            }
                        }

                        if (this.questionIndex === this.quiz.questions.length) {

                       //     console.log(this.quiz.questions.length);

                            var self = this;

                            if (!this.isPost) {

                                $.ajax({
                                    type: "GET",
                                    url: "/ajax/send_bonus.php",
                                    data: {
                                        userID: <?php echo $userID ? $userID : $nobody;?>,
                                        score: score
                                    },
                                    cache: false,
                                    success: function (response) {
                                        console.log(response);
                                        self.ajaxResponse = response;

                                    },
                                    complete: function () {
                                    }
                                }).then(this.isPost = true);

                            }

                            /*fetch('/ajax/send_bonus.php',{
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                data:  {
                                    userID: <?php // echo $userID ? $userID : $nobody;?>,
                                    score: score
                                },
                            })
                                .then((response) => {
                                    if(response.ok) {
                                        return response.json();
                                    }

                                    throw new Error('Network response was not ok');
                                })
                                .then((json) => {
                                    this.posts.push({
                                        ajaxResponse: json,
                                    });
                                })
                                .catch((error) => {
                                    console.log(error);
                                });*/


                        }

                        return score;

                        //return this.userResponses.filter(function(val) { return val }).length;
                    }
                }
            });

    </script>
    </body>


   <? endif ?>