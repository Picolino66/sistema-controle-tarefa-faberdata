myApp.controller('tarefaController', function ($scope, $state, $http, $location) {
    var tc = this;
    var urlApi = 'http://localhost/sistema-controle-tarefa-faberdata/api/Tarefa/'
    $scope.currentPage = 1;
    $scope.maxSize = 3;
    $scope.checkboxModel = {
        value1 : false
      };

    this.loadData = function () {
        $http.get(urlApi).then(function (response) {
            tc.tarefa_list = response.data;
            $scope.total_row = response.data.total;
        });
    };

    tc.loadData();

    this.addTarefa = function (dados) {
        $http.post(urlApi, dados).then(function (response) {
            document.getElementById("criarTarefa").reset();
            $('#criarTarefaModal').modal('toggle');
            tc.loadData();
        });
    };

    this.editModalTarefa = function (tarefaId) {
        $http.get(urlApi + tarefaId).then(function (response) {
            tc.tarefaDados = response.data;
        });
    };

    this.updateTarefa = function (tarefaId, dados) {
        dados.titulo = dados.Titulo;
        dados.descricao = dados.Descricao;
        if($('#ipunt-checkbox')[0].checked == true)
            dados.concluido = 1;
        else dados.concluido = 0;
        delete dados.Titulo;
        delete dados.Descricao;
        delete dados.Concluido;
        $http.put(urlApi + tarefaId, dados).then(function (response) {
            $('#editModalTarefa_modal').modal('toggle');
            tc.loadData();
        });
    };

    this.getTarefa = function (tarefaId) {
        $http.get(urlApi + tarefaId).then(function (response) {
            tc.viewTarefaDados = response.data;
        });
    };

    this.deleteModalTarefa = function (tarefaId) {
        $http.delete(urlApi + tarefaId).then(function (response) {
            tc.loadData();
        });
    };

});