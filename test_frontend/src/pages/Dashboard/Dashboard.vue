<template>
  <div class="dashboard-page">
    <h3 class="page-title">Students Record</h3>
      
    <b-row>
        <b-col xs="12">
            <div class="table-responsive">
              <table class="table table-striped  mb-0 requests-table table-responsive">
                <thead>
                  <tr class="text-muted">
                    <th>NAME</th>
                    <th v-for="subject in subjects"
                      :key="subject.id"
                    >
                    {{subject.subject_name}}
                    </th>
                    <th>Mean</th>
                    <th>Median</th>
                    <th>Mode</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="data in student_data"
                    :key="data.id"
                  >
                    <td>{{data.lname +' '+data.fname+' '+data.mname}}</td>
                    <td 
                      v-for="score in data.result" 
                      :key="score.subject_id"
                      >
                      {{score.score}}
                    </td>
                    <td>
                      {{data.mean==0 ?'-':data.mean}}
                    </td>
                    <td>
                      {{data.median == 0 ?'-':data.median}}
                    </td>
                    <td>
                      {{data.mode?data.mode:'-'}}
                    </td>
                    <th>
                        <div 
                          class="btn-actions-pane-right actions-icon-btn"
                          >
                            <b-dropdown
                          toggle-class="btn-icon btn-icon-only"
                          variant="link"
                          right
                        >
                          <span slot="button-content">
                          </span>
                            <div>
                              <button
                                type="button"
                                tabindex="1"
                                class="dropdown-item"
                                @click="$bvModal.show('add-score');student_id=data.id" 
                              >
                                <i class="dropdown-icon lnr-inbox"> </i
                                ><span>Upload Scores</span>
                              </button>
                          </div>
                          <div>
                              <button
                                type="button"
                                tabindex="1"
                                class="dropdown-item"
                                @click="deleteScores(data.id)" 
                              >
                                <i class="dropdown-icon lnr-inbox"> </i
                                ><span>Purge Scores</span>
                              </button>
                          </div>
                        </b-dropdown>
                            
                        </div>
                    </th>
                    
                  </tr>
                </tbody>
              </table>
            </div>
        </b-col>
      </b-row>
      <b-modal id="add-score" hide-footer :title="'Add Student Score'">
          <AddScore @score_added="get_students_result" :my_modal="$bvModal" :student_id="student_id"/>
      </b-modal>
  </div>
</template>

<script>
import Widget from '@/components/Widget/Widget';
import BigStat from './components/BigStat/BigStat';
import axios from 'axios';
import AddScore from "./Partials/add-score";


import { Chart } from 'highcharts-vue';

export default {
  name: 'Dashboard',
  components: {
    Widget, BigStat, highcharts: Chart,
    AddScore
  },
  data() {
    return {
      student_data:{},
      subjects:{},
      student_id:{},
    };
  },
  methods: {
    get_students_result(){
      axios
        .get('http://test.com/api/retrieve_score')
        .then((res) => {
           this.student_data=res.data.data
        })
        .catch((err) => {
        })
        .finally(() => {
        });
    },
    get_subjects(){
      axios
        .get('http://test.com/api/get_subjects')
        .then((res) => {
           this.subjects = res.data.data
        })
        .catch((err) => {
        })
        .finally(() => {
        });
    },
    deleteScores(id){
      swal({
        title: "Purge Scores?",
        text: "Are you sure you want to perform this operation?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            axios
            .post('http://test.com/api/purge_scores',{id:id})
            .then(res => {
                this.getSettings();
            })
            .catch(err => {
                swal("Error", err.response.data.message, "error");
            })
            .finally(er => {
            });
            this.get_students_result()
          swal("Yaay! Your scores have been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your Scores are safe!");
        }
      });
    }
  },
  mounted (){
    this.get_students_result();
    this.get_subjects()
  },
  computed: {
    donut() {
      let revenueData = this.getRevenueData();
      let {danger, info, primary} = this.appConfig.colors;
      let series = [
        {
          name: 'Revenue',
          data: revenueData.map(s => {
            return {
              name: s.label,
              y: s.data
            }
          })
        }
      ];
      return {
        chart: {
          type: 'pie',
          height: 120
        },
        credits: {
          enabled: false
        },
        title: false,
        plotOptions: {
          pie: {
            dataLabels: {
              enabled: false
            },
            borderColor: null,
            showInLegend: true,
            innerSize: 60,
            size: 100,
            states: {
              hover: {
                halo: {
                  size: 1
                }
              }
            }
          }
        },
        colors: [danger, info, primary],
        legend: {
          align: 'right',
          verticalAlign: 'middle',
          layout: 'vertical',
          itemStyle: {
            color: '#495057',
            fontWeight: 100,
            fontFamily: 'Montserrat'
          },
          itemMarginBottom: 5,
          symbolRadius: 0
        },
        exporting: {
          enabled: false
        },
        series
      };
    }
  }
};
</script>

<style src="./Dashboard.scss" lang="scss" />
