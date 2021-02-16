let actions = {
    createAtividade({ commit }, atividade) {
        axios.post('http://192.168.254.15:8085/api/', atividade)
            .then(res => {
                commit('CREATE_ATIVIDADE', res.data)
            }).catch(err => {
                console.log(err)
            })
    },
    fetchAtividades({ commit }) {
        axios.get('http://192.168.254.15:8085/api/')
            .then(res => {
                commit('FETCH_ATIVIDADES', res.data)
            }).catch(err => {
                console.log(err)
            })
    },
    deleteAtividade({ commit }, atividade) {
        axios.delete(`http://192.168.254.15:8085/api//${atividade.id_atividade_comercial}`)
            .then(res => {
                if (res.data === 'ok')
                    commit('DELETE_ATIVIDADE', atividade)
            }).catch(err => {
                console.log(err)
            })
    }
}

export default actions
