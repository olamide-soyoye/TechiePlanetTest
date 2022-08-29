<template>
    <div class="main-card card">
    <!-- <VueElementLoading :active="winnerLoading" spinner="line-scale" color="var(--primary)" /> -->
    <form  @submit.prevent="submitScore">    
        <div class="card-body">
            <div>
                <div class="row mb-2">
                    <div class="col-md-12 mb-2" v-for="(s,i) in subjects_and_score" :key="i">
                        <strong>{{s.subject_name}}:</strong>
                        <input type="number" required placeholder="score" max="100" min="0" class="form-control" v-model="s.score"  aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block text-right card-footer ">
            <button type="submit" class="mr-2 btn btn-link btn-sm btn btn-success">Save</button>
            <button type="button" class="mr-2 btn btn-link btn-sm text-danger" @click="closeMe">Cancel</button>
        </div>
    </form>

  </div>
</template>
<script>
    import axios from 'axios';
    import toastr from "toastr";
    export default {
        props: [
            'my_modal',
            'student_id',
        ],
        components: {
            // VueElementLoading
        },
        metaInfo() {
            return {
            title: "Add student Score"
            };
        },
        data() {
            return {
                winnerLoading: false,
                programmes: {},
                allApplicants:{},
                errorMsg:'',
                form:{},
                subjects_and_score:[]        }
        },
        methods: {
            closeMe() {
                this.my_modal.hide("add-score");
            },
            submitScore(){
                let payload = {
                    "student_id":this.student_id,
                    "result": this.subjects_and_score
                }
                axios.post('http://test.com/api/score_student',payload)
                .then(res => {
                    this.closeMe()
                    toastr.success("Scores submitted successfully")
                    this.$emit('score_added');
                }).catch(err => {
                    return toastr.error("Unable to upload scores")
                }).finally(() => {
                    this.load_analytics=false
                })

            },
            get_subjects(){
                axios
                .get('http://test.com/api/get_subjects')
                .then((res) => {
                    this.subjects_and_score = res.data.data.map(el=>{
                        return {
                            'subject_id':el.id,
                            'subject_name':el.subject_name,
                            'score':''
                        }
                    })
                })
                .catch((err) => {
                })
                .finally(() => {
                });
            },


        },
        mounted(){
            this.get_subjects()
        }
    }
</script>
<style scoped>

</style>