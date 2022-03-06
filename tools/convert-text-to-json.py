def file_manipulation(data):
    try:
        listed = data.readlines()
        for i in range(0, len(listed)):
            listed[i] = listed[i].replace("\n", "")
            listed[i] = listed[i] + "<br>"
        stringed = "".join(listed)
        stringed = '"' + stringed + '"'
        return stringed

    finally:
        file.close()


def pathFinder():
    path = str(__file__).replace("convert-text-to-json.py", "")

    return str(path)


try:
    file = open(
        pathFinder() + str("text.txt"),
        "r",
    )
    toSave = file_manipulation(file)
    f = open(pathFinder() + str("jsoned.txt"), "w")
    f.write(toSave)
    f.close()

except Exception as excpt:

    print(excpt)
