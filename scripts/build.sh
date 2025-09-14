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
cp -r src/* build/
cobc -x build/hello_world.cbl -o build/hello_world
cobc -x build/coboltut3.cbl -o build/coboltut3
echo "About to remote build/hello_world.cbl and coboltut3.cbl..."
rm build/*.cbl
cp -r build/* dist/
ls -Rl

if [ "$cleanUp" == "true" ]; then
  rm -Rf build
fi
