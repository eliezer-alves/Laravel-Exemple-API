let actions = {
    createAtividade({ commit }, atividade) {
        return axios.post('http://localhost:8000/api/atividade_comercial', atividade)
            .then(res => {
                commit('CREATE_ATIVIDADE', res.data)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    fetchAtividades({ commit }) {
        return axios.get('http://localhost:8000/api/atividade_comercial')
            .then(res => {
                commit('FETCH_ATIVIDADES', res.data)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    updateAtividade({ commit }, atividade) {
        return axios.put(`http://localhost:8000/api/atividade_comercial/${atividade.id_atividade_comercial}`, { ...atividade })
            .then(res => {
                console.log(res);
                commit('UPDATE_ATIVIDADE', res.data)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    deleteAtividade({ commit }, atividade) {
        return axios.delete(`http://localhost:8000/api/atividade_comercial/${atividade.id_atividade_comercial}`)
            .then(res => {
                if (res.status === 200)
                    commit('DELETE_ATIVIDADE', atividade)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    },
    createCliente({ commit }, cliente) {
        console.log(cliente);
        return axios.post(`http://localhost:8000/api/cliente`, cliente)
            .then(res => {
                if (res.status === 200)
                    commit('CREATE_CLIENTE', cliente)
            }).catch(err => {
                commit('GET_ERRORS', err.response.data.errors)
            })
    }
}

export default actions
