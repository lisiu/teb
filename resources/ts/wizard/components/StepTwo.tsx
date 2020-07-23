import * as React from 'react'
import {Dispatch, FC, useEffect, useRef, useState} from 'react'
import Step from "./Step";
import StepForward from "./StepForward";
import StepBackward from "./StepBackward";
import {WizardData} from "./Wizard";
import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import ToggleButton from "react-bootstrap/ToggleButton";
import ToggleButtonGroup from "react-bootstrap/ToggleButtonGroup";
import {v4 as uuidv4} from 'uuid';


interface Props extends Step {
    visible: boolean;
    minLettersCount: number;
    maxLettersCount: number;
    data: WizardData;
    setData: Dispatch<WizardData>;
}

const StepTwo: FC<Props>
    = ({visible, minLettersCount, maxLettersCount, onForward, onBackward, data, setData}: Props) => {
    const [isValid, setIsValid] = useState(false)
    const [availableLetters, setAvailableLetters] = useState([])
    const [selectedLetters, setSelectedLetters] = useState([])
    const uuidRef = useRef(null)
    useEffect(() => validate(), [visible])
    useEffect(() => {
        setAvailableLetters((data.province + data.email)
            .replace(/[^\p{L}]/gu, '')
            .split('')
            .sort(() => Math.random() < 0.5 ? -1 : 1)
        )
        setSelectedLetters([])
    }, [data.email, data.province])
    useEffect(() => validate(), [selectedLetters, data.uuid])

    const validate = () => {
        if (uuidRef.current) {
            setIsValid(
                uuidRef.current.checkValidity()
                && selectedLetters.length >= minLettersCount
            )
        }
    }

    const handleUuidChange = (event) => {
        setData({...data, uuid: event.target.value})
    }

    const handleGenerateUuidClick = () => {
        setData({...data, uuid: uuidv4()})
    }

    const handleLettersChange = (val) => {
        if (val.length > maxLettersCount) {
            return
        }
        setSelectedLetters(val)
        setData({...data, letters: availableLetters.filter((letter, key) => val.indexOf(key) > -1)})
    }

    if (!visible) {
        return null
    }
    return (
        <Card bg="light">
            <Card.Header as="h5">Krok 2/3</Card.Header>
            <Card.Body>
                <Form.Group style={{overflow: "auto"}}>
                    {maxLettersCount === minLettersCount
                        ? <Form.Label>Wybierz {maxLettersCount} liter</Form.Label>
                        : <Form.Label>Wybierz od {minLettersCount} do {maxLettersCount} liter</Form.Label>
                    }
                    <br/>
                    <ToggleButtonGroup type="checkbox" value={selectedLetters} onChange={handleLettersChange}>
                        {availableLetters.map((letter, key) => (
                            <ToggleButton variant="outline-dark" value={key}>{letter}</ToggleButton>
                        ))}
                    </ToggleButtonGroup>
                    <Form.Text
                        hidden={selectedLetters.length >= minLettersCount}
                        className="text-danger"
                        id="dateStartHelpBlock">
                        Wybrano zbyt mało liter
                    </Form.Text>
                </Form.Group>
                <Form.Group className={'was-validated'}>
                    <Form.Group controlId="formGridUuid">
                        <Form.Label>UUID</Form.Label>
                        <InputGroup className="mb-3">
                            <Form.Control
                                required
                                ref={uuidRef}
                                value={data.uuid}
                                onChange={handleUuidChange}
                                size="lg"
                                name="uuid"
                                type="text"
                                pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89ABab][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$"
                            />
                            <InputGroup.Append>
                                <Button variant="outline-dark" onClick={handleGenerateUuidClick}>Wygeneruj</Button>
                            </InputGroup.Append>
                        </InputGroup>
                    </Form.Group>
                </Form.Group>
                <StepForward disabled={!isValid} onClick={onForward}/>
                <StepBackward onClick={onBackward}/>
            </Card.Body>
        </Card>
    )
}

export default StepTwo
