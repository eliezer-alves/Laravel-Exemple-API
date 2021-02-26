const params = new URLSearchParams()
params.append('grant_type', process.env.MIX_GRANT_TYPE);
params.append('client_id', process.env.MIX_CLIENT_ID);
params.append('client_secret', process.env.MIX_CLIENT_SECRET);

const header = {
    'Content-Type': 'application/x-www-form-urlencoded',
}

const API_URL = process.env.MIX_API_URL;

export { params, header, API_URL };