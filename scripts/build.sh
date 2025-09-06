echo "You're currently working in:"
pwd

cleanUp="true"

if [ $# -gt 0 ]; then
  if [ $1 == "false"]; then
    cleanUp="false"
  fi 
fi

if [ -d dist ]; then
  rm -Rf dist
fi
if [ -d build ]; then
  rm -Rf build
fi

mkdir dist build
cp src/* build/
cobc -x build/hello_world.cbl -o build/hello_world
echo "About to remote build/hello_world.cbl"
rm build/hello_world.cbl
echo "Removed"
cp build/* dist/
ls -Rl

if [ "$cleanUp" == "true" ]; then
  rm -Rf build
fi

