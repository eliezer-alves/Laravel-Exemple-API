const params = new URLSearchParams()
params.append('client_id', process.env.MIX_CLIENT_ID_GRANT_PWS);
params.append('client_secret', process.env.MIX_CLIENT_SECRET_GRANT_PWS);

const config = {
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
}

export { params, config };