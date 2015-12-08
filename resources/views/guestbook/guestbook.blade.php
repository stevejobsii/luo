@extends('app')

@section('content')

<div id="guestbook" class="col-md-12" style="margin-top:-20px;">
  <img src="/images/catalog/womansmiling.jpg"style="margin-bottom:10px;">
        <form method="POST" v-on="submit: onSubmitForm">

            <div class="form-group">
                <label for="name">
                    昵称:
                    <span class="error" v-if="! newMessage.name">*</span>
                </label>
                <input type="text" name="name" id="name" class="form-control" v-model="newMessage.name">
            </div>

            <div class="form-group">
                <label for="message">
                    请输入您的留言:
                    <span class="error" v-if="! newMessage.message">*</span>
                </label>
                <textarea type="text" name="message" id="message" class="form-control" v-model="newMessage.message"></textarea>
            </div>

            <div class="form-group" v-if="! submitted">
                <button type="submit" class="btn btn-primary"v-attr="disabled: errors">
                提交
                </button>
                <i>&nbsp;&nbsp;好去处网诚邀请热心网友给我们的网站提修改意见和建议，以求进一步改进网站。</i>
            </div>

            <div class="alert alert-success" v-if="submitted">Thanks!</div>

        </form>

        <script type="text/x-template" id="grid-template">
          <div  class="guestbook">
          <table class="table table-striped">
            <thead>
              <tr>
                <th v-repeat="key: columns"
                  v-on="click:sortBy(key)"
                  v-class="active: sortKey == key">
                  @{{key | capitalize}}
                  <span class="arrow"
                    v-class="reversed[key] ? 'dsc' : 'asc'">
                  </span>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-repeat="
                entry: data
                | filterBy filterKey
                | orderBy sortKey reversed[sortKey]">
                <td v-repeat="key: columns">
                  @{{entry[key]}}
                </td>
              </tr>
            </tbody>
          </table>
          </div>
        </script>

        <!-- demo root element -->

        <form id="search" class="inner-addon right-addon">
            <input name="query" v-model="searchQuery" class="form-control" placeholder='搜索留言板上任何关键字'><i class="glyphicon glyphicon-search"></i>
        </form>
        <demo-grid
            data="@{{messages}}"
            columns="@{{gridColumns}}"
            filter-key="@{{searchQuery}}">
        </demo-grid>
</div>  
@stop

@section('js')
        <script src="//cdn.bootcss.com/vue/0.12.16/vue.min.js"></script>
        <script src="//cdn.bootcss.com/vue-resource/0.1.16/vue-resource.min.js"></script>
<script type="text/javascript">
        //guestbook
// register the grid component
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
Vue.component('demo-grid', {
  template: '#grid-template',
  replace: true,
  props: ['data', 'columns', 'filter-key'],
  data: function () {
    return {
      data: null,
      columns: null,
      sortKey: '',
      filterKey: '',
      reversed: {}
    }
  },
  compiled: function () {
    // initialize reverse state
    var self = this
    this.columns.forEach(function (key) {
      self.reversed.$add(key, false)
    })
  },
  methods: {
    sortBy: function (key) {
      this.sortKey = key
      this.reversed[key] = !this.reversed[key]
    }
  }
})

new Vue({
    el: '#guestbook',
    data: {
        searchQuery: '',
        gridColumns: ['name', 'message'],
        reverse : true,
        newMessage: { name: '', message: '' },
        submitted: false
    },
    computed: {
        errors: function() {
            for (var key in this.newMessage) {
                if ( ! this.newMessage[key]) return true;
            }
            return false;
        }
    },
    ready: function() {
        this.fetchMessages();
    },
    methods: {
        fetchMessages: function() {
            this.$http.get('/api/messages', function(messages) {
                this.$set('messages', messages);
            });
        },
        onSubmitForm: function(e) {
            e.preventDefault();
            var message = this.newMessage;
            this.messages.push(message);
            this.newMessage = { name: '', message: '' };
            this.submitted = true;
            this.$http.post('api/messages', message);
        }
    }
});
</script>
@stop