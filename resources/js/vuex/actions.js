let actions = {
    createAtividade({ commit }, atividade) {
        return axios.post('http://192.168.254.15:8085/api/atividade_comercial', atividade)
            .then(res => {
                commit('CREATE_ATIVIDADE', res.data)
            }).catch(err => {
                console.log(err)
            })
    },
    fetchAtividades({ commit }) {
        console.log('aqui');
        return axios.get('http://192.168.254.15:8085/api/atividade_comercial')
            .then(res => {
                commit('FETCH_ATIVIDADES', res.data)
            }).catch(err => {
                console.log(err)
            })
    },
    deleteAtividade({ commit }, atividade) {
        console.log(atividade);
        return axios.delete(`http://192.168.254.15:8085/api/atividade_comercial/${atividade.id_atividade_comercial}`)
            .then(res => {
                if (res.data === 'ok')
                    commit('DELETE_ATIVIDADE', atividade)
            }).catch(err => {
                console.log(err)
            })
    }
}

export default actions
