#! /bin/bash
# exit script when any command ran here returns with non-zero exit code
set -e

COMMIT_SHA1=$CIRCLE_SHA1

# We must export it so it's available for envsubst
export COMMIT_SHA1=$COMMIT_SHA1

# since the only way for envsubst to work on files is using input/output redirection,
#  it's not possible to do in-place substitution, so we need to save the output to another file
#  and overwrite the original with that one.
if [ $CIRCLE_BRANCH == 'main' ]; then
  envsubst <./kube/stage/web-deployment.yml >./kube/stage/web-deployment.yml.out
  mv ./kube/stage/web-deployment.yml.out ./kube/stage/web-deployment.yml

  ./kubectl \
    --kubeconfig=/dev/null \
    --server=$KUBERNETES_SERVER \
    --token=$KUBERNETES_TOKEN \
    apply -f ./kube/stage/

elif [ $CIRCLE_BRANCH == 'release' ]; then
  envsubst <./kube/prod/web-deployment.yml >./kube/prod/web-deployment.yml.out
  mv ./kube/prod/web-deployment.yml.out ./kube/prod/web-deployment.yml

  ./kubectl \
    --kubeconfig=/dev/null \
    --server=$KUBERNETES_SERVER_PROD \
    --token=$KUBERNETES_TOKEN_PROD \
    apply -f ./kube/prod/
else
  exit 1
fi