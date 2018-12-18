# Server Status Receiver - PHP

A simple data receiver for [onebytegone/server-status](https://github.com/onebytegone/server-status/).

## Sending data to the receiver

In the following examples, replace `http://localhost:8000/` with the address that you have
deployed the receiver to.

### From Linux

```bash
ENDPOINT='http://localhost:8000/' && \
   NAME=$(hostname) && \
   IP=$(hostname --ip-address) && \
   echo curl -s "${ENDPOINT}?name=${NAME}&ip=${IP}"
```

### From OS X

```bash
ENDPOINT='http://localhost:8000/' && \
   NAME=$(hostname) && \
   IP=$(ipconfig getifaddr en0) && \
   curl -s "${ENDPOINT}?name=${NAME}&ip=${IP}"
```


## License

This is released under the MIT license. See [LICENSE.md](LICENSE.md) for more information.
